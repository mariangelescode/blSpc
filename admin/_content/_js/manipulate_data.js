const URL = '_content/_php/controller.php';
const objActivity = {}
const userCoins = {}
let result, result2;


const get_center = ( data ) => {
    result = '';
    if(data.success){
        result += `<option value=0>Selecciona un centro</option>`;
        data.data.datos.forEach(element => {
            result += `<option value=${element.id}>${element.nameCenter}</option>`;
        });
        document.getElementById('center').innerHTML = result;
        send_action_get_activity();
    }
}

const get_activity = ( data ) => {
    result = '';
    result += `<option value=0>Selecciona una actividad</option>`;
    if(data.success){
        data.data.datos.forEach(element => {
            result += `<option value=${element.id}>${element.activity}</option>`;
        });
        document.getElementById('activity').innerHTML = result;
    }else{
        result = '';
        result += `<option value=0>Selecciona una actividad</option>`;
        document.getElementById('activity').innerHTML = result;
    }
    document.getElementById('activity').onchange = () => {drawContainerPoints( data )};    
}

const drawContainerPoints = ( data ) => {
    document.getElementById('containerInpUser').style.display = 'block';
    const idActivity = document.getElementById('activity').value;
    result = '';
    if(data.success){
        data.data.datos.forEach(element => {
            const { id, activity, center, coins, minCoins, maxCoins} = element;
        
            if(id == idActivity){
                if(coins == 0){
                    if(minCoins && maxCoins){
                        result += `<div class="container__radioPoints">`;
                        for (let i = 1; i <= maxCoins; i++) {
                            result += `
                                <div>
                                    <span>${i}</span>
                                    <input type="radio" name="coin" id=inpCoin_${i} class="radio__inp--height" value=${i} onchange="coins(${idActivity}, ${i}, ${center})">
                                </div>
                            `;
                        }
                        result += `</div>`;
                        result += `
                            <div class="container__btnAddPoints textAlign--center">
                                <button class="btn__addpoints" onclick="validatePoints()">Agregar puntos</button>
                            </div>
                        `;
                    }
                }else{
                    result += `
                        <div class="container__btnAddPoints textAlign--center">
                            <button class="btn__addpoints" onclick="coins(${idActivity}, ${coins}, ${center}, 'validate')">Agregar puntos</button>
                        </div>
                    `;
                }
            }
        });
        document.getElementById('containerPoints').innerHTML = result;
    }
}

const coins = ( idActivity, coins, idCenter, validate='no' ) => {
    userCoins.idActivity = idActivity;
    userCoins.coins = coins;
    userCoins.idCenter = idCenter;
    if(validate == 'validate'){
        validatePoints();
    }
}


const validatePoints = () => {
    if(!!document.getElementById('user').value == false){
        alert('Necesitas el usuario');
    }else{
        userCoins.user = document.getElementById('user').value
        if(Object.keys(userCoins).length == 4){
            for (const element in userCoins) {
                if(!!userCoins[element] == false){
                    alert('Escribe el:', element);
                    return
                }else{
                    send_action_add_points( userCoins );
                    return
                }
            }
        }
    }
}

const add_points = ( data ) => {
    if(data == 500){
        alert('El registro ya se realizó con anterioridad');
    }else{
        if(data.success){
            alert('Ha sido aplicado');
            document.getElementById('user').value = '';
            let inpCoins = document.getElementsByName('coin')
            inpCoins.forEach(element => {
                document.getElementById(''+element.id+'').checked = false;
            });
        }else{
            alert(data.data.message);
        }
    }
    
}

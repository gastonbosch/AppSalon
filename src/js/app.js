let step = 1;
const firstStep = 1;
const lastStep = 3;

const appointment = {
    id:'',
    name:'',
    day: '',
    hour: '',
    services:[]
} 

document.addEventListener('DOMContentLoaded',function(){
    startApp();
});

function startApp(){
    showSection();
    tabs();//Cambia la seccion cuadno se preciona el tab
    buttonPagination();
    previousPage();
    nextPage();

    queryAPI();
    getName();
    getDate();
    getHour();
    getIdClient();
    showSummary();
}

function showSection(){
    //Oculto la seccion anterior
    const lastStep = document.querySelector('.show');
    if(lastStep){
        lastStep.classList.remove('show');
    }
    
    //Muestro la seccion actual
    const currentStep = document.querySelector(`#step-${step}`);
    currentStep.classList.add('show');
    
    //Removemos la clase actual
    const lastTab = document.querySelector('.current');
    if(lastTab){
        lastTab.classList.remove('current');
    }
    
    //Resaltamos la clase actual
    const tab = document.querySelector(`[data-step="${step}"]`);
    tab.classList.add('current');
}

function tabs(){
    //Agrego el listener parar el evento click a cada uno de los tabs 
    const button = document.querySelectorAll('.tabs button');
    button.forEach(btn => {
        btn.addEventListener('click',function(e){  
            step = parseInt(e.target.dataset.step);
            showSection();
            buttonPagination();
        });
    });
}

function buttonPagination(){
    const previuos = document.querySelector('#previous');
    const next = document.querySelector('#next');

    if(step===1){
        previuos.classList.add('pagination-hide');
        next.classList.remove('pagination-hide');
    }else if(step===3){
        previuos.classList.remove('pagination-hide');
        next.classList.add('pagination-hide');
        showSummary();
    }else{
        previuos.classList.remove('pagination-hide');
        next.classList.remove('pagination-hide');
    }
}

function previousPage(){       
    const previous = document.querySelector('#previous');

    previous.addEventListener('click',function(){
        if(step <= firstStep) return;
        step--;
        buttonPagination();
        showSection();
    });
}

function nextPage(){
    const next = document.querySelector('#next');

    next.addEventListener('click',function(){
        if(step >= lastStep) return;
        step++;
        buttonPagination();
        showSection();
    });   
}

async function queryAPI(){

    try{
        const url = `${location.origin}/api/services`;
        result = await fetch(url);
        services = await result.json();
        showServices(services);

    }catch(error){
        console.log(error);
    }
}

function showServices(services){
    services.forEach(service =>{
        const {id, name, price} = service;

        const nameService = document.createElement('P');
        nameService.classList.add('name-service');
        nameService.textContent = name;

        const priceService = document.createElement('P');
        priceService.classList.add('price-service');
        priceService.textContent = `$${price}`;

        const serviceDiv = document.createElement('DIV');
        serviceDiv.classList.add('service');
        serviceDiv.dataset.idService = id;

        serviceDiv.onclick = function(){
                                selectService(service);
                            };

        serviceDiv.appendChild(nameService);
        serviceDiv.appendChild(priceService);

        document.querySelector('#services').appendChild(serviceDiv);
    });
}

function selectService(service){
    const {id} = service;
    const {services} = appointment;
    selectDiv = document.querySelector(`[data-id-service="${id}"]`);

    //Check if sevice has added
    if(services.some(addedService=>addedService.id === id)){
        //delete service
        appointment.services = services.filter(addedService=>addedService.id !== id); 
        selectDiv.classList.remove('selected');
    }else{
        //add service
        appointment.services = [...services, service];
        selectDiv.classList.add('selected');
    }
}

function getName(){
    appointment.name = document.querySelector('#name').value;
}

function getIdClient(){
    appointment.id = document.querySelector('#id').value;
}

function getDate(){
    const inputDay = document.querySelector('#date');

    inputDay.addEventListener('input',function(){
        //Obtiene el numero de dia de la semana, siendo domingo 0, lunes 1, etc
        const day = new Date(inputDay.value).getUTCDay();

        //include valida ssi existe un valor en el array 
        if([6,0].includes(day)){
            appointment.day = '';
            showAlert('we do not work on weekends', 'error','.form');
        }else{
            appointment.day = inputDay.value;
        }
    });
}

function getHour(){
    const inputHour = document.querySelector('#hour');

    inputHour.addEventListener('input',function(e){
        const hourAppointment = e.target.value;
        const hour = hourAppointment.split(':')[0];
        if(hour < 9 || hour > 20){
            e.target.value = '';
            showAlert('Not valid hour','error','.form');
        }else{
            appointment.hour = e.target.value;
        }
    });
}

function showAlert(message, type, element, hide=true){

    //Si ya existe una alerta no la vuelvo a mostrar
    const previousAlert = document.querySelector('.alert');
    if(previousAlert){
        previousAlert.remove();
    };

    const divAlert = document.createElement('DIV');
    divAlert.textContent = message;
    divAlert.classList.add('alert');
    divAlert.classList.add(type);

    const divElement = document.querySelector(element);
    divElement.appendChild(divAlert);

    if(hide){
        setTimeout(()=>{
            divAlert.remove();
        },3000);
    }
}

function showSummary(){
    const summary = document.querySelector('.content-summary');

    //Clean the content of summary
    while(summary.firstChild){
        summary.removeChild(summary.firstChild);
    }

    /*Object.values() permite trata un objeto, en este caso el objeto appointment, como si fuera un array,
    y de esta manera acceder a sus propiedades como si fueran elementos de un array*/
    if(Object.values(appointment).includes("") || appointment.services.length===0){
        showAlert('Incomplete data','error','.content-summary',false);
        return;
    }

    const {name, day, hour, services} = appointment;

    //Heading to services
    const headingService = document.createElement('H3');
    headingService.textContent = 'Services is summary';
    summary.appendChild(headingService);

    services.forEach(service => {
        const {id, name, price} = service;
        
        const contentService = document.createElement('DIV');
        contentService.classList.add('content-service');

        const nameService = document.createElement('P');
        nameService.textContent = name;

        const priceService = document.createElement('P');
        priceService.innerHTML = `<span>Price: </span>$${price}`;

        contentService.appendChild(nameService);
        contentService.appendChild(priceService);

        summary.appendChild(contentService);
    });   

    //Heading to appointment
    const headingAppointment = document.createElement('H3');
    headingAppointment.textContent = 'Appointment is summary';
    summary.appendChild(headingAppointment);

    const nameClient = document.createElement('P');
    nameClient.innerHTML = `<span>Name: </span>${name}`;

    //Format date
    const dateObj = new Date(day);
    const dayF = dateObj.getDay();//Cada vez que se instancia el obeto date se resta un dia(se instancia 2 veces)
    const month = dateObj.getMonth();
    const year = dateObj.getFullYear();

    const dateUTC = new Date(Date.UTC(year,month, dayF));

    const options = {weekday: 'long', year:'numeric',month:'long', day:'numeric'};
    const dateFormat = dateUTC.toLocaleDateString('es-AR',options);

    const dateClient = document.createElement('P');
    dateClient.innerHTML = `<span>Date: </span>${dateFormat}`;

    const hourClient = document.createElement('P');
    hourClient.innerHTML = `<span>Hour: </span>${hour} Hours`;

    //button book appointment
    const buttonReserve = document.createElement('BUTTON');
    buttonReserve.classList.add('button');
    buttonReserve.textContent = 'Book Appointment';
    buttonReserve.onclick = bookAppointment;

    summary.appendChild(nameClient);
    summary.appendChild(dateClient);
    summary.appendChild(hourClient);

    summary.appendChild(buttonReserve);
}

async function bookAppointment(){

    const {name, day, hour, services, id} = appointment;

    //El forEach itera sobre el array, el map accede a los datos indexando estos directamente
    const idServices = services.map(service => service.id);

    const data = new FormData();

    data.append('date',day);
    data.append('time',hour);
    data.append('userId',id);
    data.append('services',idServices);

    try {
        //request to the API
        const url = `${location.origin}/api/appointment`;
        const response = await fetch(url,{
            method:'POST',
            body: data
        });

        const result = await response.json();

        if(result.resultado){
            Swal.fire({
                icon: 'success',
                title: 'Appointment created',
                text: 'Your appointment was created successfully',
                button: 'OK'
            }).then(()=>{
                setTimeout(()=>{
                    window.location.reload();
                },2000);
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error saving the appointment'
        });
    }

    
    console.log(result);

    //console.log([...data]);
}
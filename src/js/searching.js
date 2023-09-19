document.addEventListener('DOMContentLoaded',function(){
    startApp();
});

function startApp(){
    searchByDate();
}

function searchByDate(){
    const inputDate = document.querySelector('#date');

    inputDate.addEventListener('input',function(e){
        const dateSelected = e.target.value;

        window.location = `?date=${dateSelected}`;
    });
}
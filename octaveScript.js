const btn = document.querySelector('#submit');
const command = document.querySelector('#prikaz');
const cmdResponse = document.querySelector('#response');

btn.addEventListener('click', () => {
    getDataFromCmd(command.value);
})

const getDataFromCmd = (cmdInput) => {
    let url = 'api/suspension?key=abcd&command=' + encodeURIComponent(cmdInput);
    fetch(url,
        {method: 'get'}
    ).then(response => response.json()
    ).then(data => {
        cmdResponse.innerHTML = '<a>'+data+'</a>'
    })
}


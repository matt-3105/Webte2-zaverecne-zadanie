const btn = document.querySelector('#submit');
const chartCanvas = document.getElementById('my-chart');
const input = document.querySelector('#input');
const nameInput = document.querySelector('#name');
const c = document.querySelector('#car');
let ctx = c.getContext("2d");
const playBtn = document.querySelector('#play');
const activeUsers = document.querySelector('#users');
const graph = document.querySelector('#graph');
const animation = document.querySelector('#animation');
const chartCancvasWrapper = document.querySelector('#my-chart-wrapper');

graph.addEventListener( 'click', () =>  {
    if(graph.checked === true){
        chartCancvasWrapper.style.display = "block";
    } else {
        chartCancvasWrapper.style.display = "none";
    }
})

animation.addEventListener( 'click', () =>  {
    if(animation.checked === true){
        c.style.display = "block";
    } else {
        c.style.display = "none";
    }
})


const data = {
    labels: [0],
    datasets: [{
        label: 'car',
        data: [],
        fill: false,
        borderColor: 'red',
        tension: 0
    },{
        label: 'wheel',
        data: [],
        fill: false,
        borderColor: 'blue',
        tension: 0
    }]
}

const config = {
    type: 'line',
    data: data,
    options: {
        elements: {
            point: {
                radius: 0
            }
        },
        animation: false,
        responsive: false,
        scales: {
            y: {
                title : {
                    display: true,
                    text: 'x[m]'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 't[s]'
                }
            }
        }
    }
}

const chart = new Chart(chartCanvas, config);

let endPoint = null;

let x = []
let t = [];
let r = [];
let id = null;
let joinedId = null;
let drawing = false;
let interval;

const socket = new WebSocket('wss://site109.webte.fei.stuba.sk:9001');

btn.addEventListener('click', () => {
    if(isValidR(input.value)){
        if(id === null && nameInput.value){
            const msg = {
                type: 'create',
                name: nameInput.value
            }
            socket.send(JSON.stringify(msg));
        }else{
            getDataAndDraw(input.value);
        }

    }
})

const getDataAndDraw = (rInput) => {
    let url = 'api/suspension?key=abcd&r=' + rInput
    if(endPoint){
        url += '&start=' + endPoint;
    }
    fetch(url,
        {method: 'get'}
    ).then(response => response.json()
    ).then(data => {
        let offset = 501;
        if(x.length !== 0){
            data.t = data.t.slice(1, 501);
            data.x = data.x.slice(1, 501);
            offset--;
        }
        saveData(data, [rInput]);
        if(id !== null){
            sendData(data.t, data.x, [rInput], 'append');
        }
        endPoint = data.x[data.x.length-1].toString() + ',' + data.t[data.t.length-1];
        draw(t.length - offset);
    })
}

const isValidR = (input) => {
    if(!isNaN(input)){
        input = parseFloat(input);
        if( input >= -0.45 && input <= 0.45){
            if(r.length > 0 && Math.abs(input - r[r.length-1]) <= 0.15){
                return true;
            }else if(r.length === 0 && Math.abs(input) <= 0.15){
                return true;
            }
        }
    }
    return false;
}

const sendData = (t, x, r, type) => {
    const msg = {
        type: type,
        x: x,
        t: t,
        r: r,
        id: id
    };
    socket.send(JSON.stringify(msg));
}

const saveData =(data, rInput) => {
    t = t.concat(data.t);
    x = x.concat((data.x));
    r = r.concat(rInput);
}

const draw = (start) => {
    if (drawing === false)
    {
        const len = t.length
        chart.data.labels = t;
        interval = setInterval(() => {
            drawing = true;
            if(start === t.length){
                clearInterval(interval);
                drawing = false;
                return;
            }
            if(len !== t.length){
                chart.data.labels = t;
            }
            chart.data.datasets[0].data.push(x[start][2]);
            chart.data.datasets[1].data.push(x[start][0]);
            chart.update();
            ctx.clearRect(0,0,c.width,c.height);
            drawAnimationFrame(x[start][0], x[start][2], r[Math.floor(start/501)])
            start++;
        }, 10)
    }

}

const drawDefault = () => {
    drawGround(0);
    drawWheel(0, 330);
    drawSpring(230, 330);
    drawCar(0, 330);
    drawSpring(90, 190);
}

const drawAnimationFrame = (x, y, r) => {
    const ground = drawGround(r*100);
    const wheel = drawWheel(r - x, ground);
    drawSpring(wheel + 40, ground);
    const car = drawCar(y, ground);
    drawSpring(car + 40, wheel);
}

const drawGround = (r) => {
    ctx.beginPath();
    const y = 330 - r;
    ctx.rect(0, y, 60, 400 - y);
    ctx.fillStyle = 'lightgrey';
    ctx.fill();
    ctx.beginPath();
    ctx.moveTo(60, 331);
    ctx.lineTo(70, 331);
    ctx.moveTo(60, 331 - r);
    ctx.lineTo(70, 331 - r);
    ctx.moveTo(65, 331);
    ctx.lineTo(65, 331 - r);
    ctx.stroke();
    ctx.fillStyle = 'black';
    ctx.font = '20px Arial';
    ctx.fillText('r', 70, 331 - r + 5);
    return 330 - r;
}

const drawWheel = (diff, ground) => {
    ctx.beginPath();
    const y = ground - 140 - Math.round(500*diff)
    ctx.rect(0, y, 60, 40);
    ctx.fillStyle = 'blue';
    ctx.fill();
    drawLabel('2', y, ground, 101);
    return y;
}

const drawCar = (diff, ground) => {
    ctx.beginPath();
    const y = ground - 280 - Math.round(500*diff);
    ctx.rect(0, y, 60, 40);
    ctx.fillStyle = 'red';
    ctx.fill();
    drawLabel('1', y, ground, 241);
    return y;
}

const drawLabel = (index, y, ground, offset) => {
    ctx.font = '20px Arial';
    ctx.fillStyle = 'black';
    ctx.fillText('x', 70, y+44);
    ctx.font = '10px Arial';
    ctx.fillText(index, 80, y+46);
    ctx.beginPath();
    ctx.moveTo(60, ground - offset);
    ctx.lineTo(70, ground - offset);
    ctx.moveTo(60, y+39);
    ctx.lineTo(70, y+39);
    ctx.moveTo(65, ground - offset);
    ctx.lineTo(65, y + 39);
    ctx.stroke();
}

const drawSpring = (start, end) => {
    const part = Math.floor((end-start)/8);
    let endPart = Math.floor((end - (start+part*6))/4);
    let endHalf;
    if(endPart % 2 === 1){
        endHalf = (endPart+1)/2;

    }else{
        endHalf = endPart/2;
    }
    ctx.beginPath();
    ctx.moveTo(30, start);
    ctx.lineTo(30, start + endHalf);
    ctx.lineTo(50, start + part);
    for(let i = start+part; i < start+7*part; i += 2*part){
        ctx.lineTo(10, i + part);
        ctx.lineTo(50, i + 2*part);
    }
    ctx.lineTo(30, start + 7*part + endHalf);
    ctx.lineTo(30, end);
    ctx.strokeStyle = 'black';
    ctx.stroke();
}

drawDefault();

playBtn.addEventListener('click', () => {
    play();
    socket.send(JSON.stringify({type: 'play', id: id}));
})

const play = () => {
    drawing = false;
    clearInterval(interval);
    chart.data.datasets[0].data = [];
    chart.data.datasets[1].data = [];
    draw(0);
}

socket.addEventListener('message', msg => {
    const data = JSON.parse(msg.data);
    console.log(data);
    switch (data.type){
        case 'newUser':
            addUsers([data.user])
            break;
        case 'connected':
            addUsers(data.users);
            break;
        case 'created':
            id = data.id;
            getDataAndDraw(input.value);
            break;
        case 'joined':
            if(data.data.id !== joinedId){
                clear();
                saveData(data.data, data.data.r);
                draw(0);
                joinedId = data.data.id;
            }
            break;
        case 'append':
            saveData(data.data, data.data.r);
            const offset = data.data.t.length;
            if(!drawing){
                draw(t.length-offset);
            }
            break;
        case 'play':
            play();
            break;
        case 'closed':
            const activeUsers = document.getElementsByClassName('activeUser');
            for(let user of activeUsers){
                console.log(user.getAttribute('userID'));
                if(Number(user.getAttribute('userID')) === data.id){
                    user.remove();
                }
            }
            break;
    }
})

const clear = () => {
    chart.data.labels = [];
    chart.data.datasets[0].data = [];
    chart.data.datasets[1].data = [];
    t = [];
    x = [];
    r = [];
    drawing = false;
    clearInterval(interval);
}

const addUsers = (users) => {
    users.forEach(user => {
        if(user){
            const span = document.createElement('span');
            span.textContent = user.name;
            span.setAttribute('userID', user.id);
            span.classList.add('activeUser');
            if(id === user.id){
                span.style.color = 'red';
            }else{
                span.style.cursor = 'pointer';
                span.addEventListener('click', () => {
                    const msg = {
                        type: 'join',
                        id: user.id
                    };
                    socket.send(JSON.stringify(msg));
                    btn.disabled = true;
                    playBtn.disabled = true;
                    input.disabled = true;
                    nameInput.disabled = true;
                })
            }
            activeUsers.appendChild(span);
        }
    })
}

window.onbeforeunload = () => {
    if(id !== null){
        socket.send(JSON.stringify({type: 'close', id: id}));
    }
}


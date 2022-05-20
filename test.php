<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.1/chartjs-plugin-zoom.min.js" integrity="sha512-NxlWEbNbTV6acWnTsWRLIiwzOw0IwHQOYUCKBiu/NqZ+5jSy7gjMbpYI+/4KvaNuZ1qolbw+Vnd76pbIUYEG8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>
<button id="btn">test</button>
<button id="play">play</button>
<input type="text" id="input" placeholder="r" style="width: 100%" value="0.1">
<input type="text" id="name" style="width: 100%">
<canvas id="my-chart" style="height: 400px"></canvas>
<canvas id="car" width="70" height="380" style="border: solid 1px black"></canvas>
<div id="users" style="display: flex; flex-direction: column"></div>
<script>
    const btn = document.querySelector('#btn');
    const chartCanvas = document.getElementById('my-chart');
    const input = document.querySelector('#input');
    const nameInput = document.querySelector('#name');
    const c = document.querySelector('#car');
    let ctx = c.getContext("2d");
    const playBtn = document.querySelector('#play');
    const activeUsers = document.querySelector('#users');

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
            plugins: {
                zoom: {
                    zoom: {
                        wheel: {
                            enabled: true,
                        }
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
    let drawing = false;

    const socket = new WebSocket('wss://site132.webte.fei.stuba.sk:9001');

    btn.addEventListener('click', () => {
        if(id === null && nameInput.value){
            const msg = {
                type: 'create',
                name: nameInput.value
            }
            socket.send(JSON.stringify(msg));
        }else{
            getDataAndDraw(input.value);
        }

    })

    const getDataAndDraw = (rInput) => {
        let url = 'api?key=abcd&r=' + rInput
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
        const len = t.length
        chart.data.labels = t;
        const interval = setInterval(() => {
            drawing = true;
            if(start === t.length-start){
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
        ctx.stroke();
        return 330 - r;
    }

    const drawWheel = (diff, ground) => {
        ctx.beginPath();
        const y = ground - 140 - Math.round(500*diff)
        ctx.rect(0, y, 60, 40);
        ctx.fillStyle = 'blue';
        ctx.fill();
        ctx.beginPath();
        ctx.moveTo(60, ground - 101);
        ctx.lineTo(70, ground - 101);
        ctx.moveTo(60, y+39);
        ctx.lineTo(70, y+39);
        ctx.stroke();
        return y;
    }

    const drawCar = (diff, ground) => {
        ctx.beginPath();
        const y = ground - 280 - Math.round(500*diff);
        ctx.rect(0, y, 60, 40);
        ctx.fillStyle = 'red';
        ctx.fill();
        ctx.beginPath();
        ctx.moveTo(60, ground - 241);
        ctx.lineTo(70, ground - 241);
        ctx.moveTo(60, y+39);
        ctx.lineTo(70, y+39);
        ctx.stroke();
        return y;
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
        chart.data.datasets[0].data = [];
        chart.data.datasets[1].data = [];
        draw(0);
    }

    socket.addEventListener('message', msg => {
        console.log(msg);
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
                saveData(data.data, data.data.r);
                draw(0);
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
        }
    })

    const addUsers = (users) => {
        users.forEach(user => {
            const span = document.createElement('span');
            span.textContent = user.name;
            span.setAttribute('userID', user.id);
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
        })
    }

</script>
</body>
</html>
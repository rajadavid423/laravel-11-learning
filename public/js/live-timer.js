function updateTime() {
    const timeElement = document.getElementById('live_timer');
    const date = new Date();
    const formattedTime = date.getFullYear() + '-' +
        ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
        ('0' + date.getDate()).slice(-2) + ' ' +
        ('0' + date.getHours()).slice(-2) + ':' +
        ('0' + date.getMinutes()).slice(-2) + ':' +
        ('0' + date.getSeconds()).slice(-2);

    timeElement.innerHTML = `${formattedTime}`;
}

setInterval(updateTime, 1000);

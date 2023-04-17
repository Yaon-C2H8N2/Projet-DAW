function setProgress(element, pourcentage) {
    const circle = document.querySelector('circle');
    const perimetre = circle.getTotalLength();
    const progress = document.querySelectorAll('.card:nth-child(1) svg circle:nth-child(2)');
    const texte = document.querySelectorAll('.numero h2');

    const duration = Math.random() * 1500 + 500;
    const increment = pourcentage / duration;
    let start = null;

    //Couleur en fonction de la note
    if (pourcentage < 25) {
        progress[element].style.stroke = `red`;
    } else if (pourcentage < 50 && pourcentage >= 25) {
        progress[element].style.stroke = `orange`;
    }

    function animation(timestamp) {

        if (!start) start = timestamp;
        const elapsed = timestamp - start;
        const increment_Offset = increment * elapsed;

        progress[element].style.strokeDashoffset = (perimetre - (perimetre * increment_Offset) / 100).toString();
        const pourcentage_now = Math.floor((elapsed / duration) * pourcentage);
        if (pourcentage_now > 100) {
            texte[element].textContent = `100%`;
            progress[element].style.strokeDashoffset = `${1}px`;
        } else {
            texte[element].textContent = `${pourcentage_now}%`;
        }
        if (elapsed < duration) window.requestAnimationFrame(animation);
    }

    window.requestAnimationFrame(animation);
}



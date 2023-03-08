function setProgress(element, pourcentage) {
    const circle = document.querySelector('circle');
    const perimetre = circle.getTotalLength();
    const progress = document.querySelectorAll('.card:nth-child(1) svg circle:nth-child(2)');
    const texte = document.querySelectorAll('.numero h2');


    for (let i = 0; i < pourcentage; i++) {
        progress[element].style.strokeDashoffset = (perimetre - (perimetre * pourcentage) / 100).toString();
        texte[element].textContent = pourcentage;
    }

    const duration = 1500;
    const increment = pourcentage / duration;
    let start = null;


    function animation(timestamp) {

        if (!start) start = timestamp;
        const elapsed = timestamp - start;
        const increment_Offset = increment * elapsed;

        progress[element].style.strokeDashoffset = (perimetre - (perimetre * increment_Offset) / 100).toString();
        const pourcentage_now = Math.round((elapsed / duration) * pourcentage);
        texte[element].textContent = `${pourcentage_now}%`;

        if (elapsed < duration) window.requestAnimationFrame(animation);
    }

    window.requestAnimationFrame(animation);
}



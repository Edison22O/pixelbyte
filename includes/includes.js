document.addEventListener('DOMContentLoaded', function() {
    const texts = [
        "diseñadores web",
        "desarrolladores frontend",
        "desarrolladores backend",
        "desarrolladores full stack",
        "diseñadores UI/UX",
        "especialistas en SEO",
        "creadores de contenido"
    ];
    let index = 0;
    const typewriterElement = document.querySelector('.typewriter h2 .highlight');

    function updateText() {
        typewriterElement.textContent = texts[index];
        index = (index + 1) % texts.length;
    }

    setInterval(updateText, 4000);
});

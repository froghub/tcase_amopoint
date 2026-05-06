//IIFE, что бы не вызывать вручную. Но если надо - просто убрать вызов и дадть имя
(function () {
    const ENDPOINT_ADDRESS = 'http://127.0.0.1:8000/api/tracker/track';

    async function collect() {
        const data = {
            ua: navigator.userAgent,
            ref: document.referrer,
            lang: navigator.language,
        }
        try {
            fetch(ENDPOINT_ADDRESS, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data),
            })
        } catch (e) {
            console.error('Request error',e);
        }
    }
    collect(); // результат нас не интересует, потому ff
})()

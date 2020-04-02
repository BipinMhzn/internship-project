$(document).ready(function() {
    let counters = $(".count");
    let countersQuantity = counters.length;
    let counter = [];

    for (let i = 0; i < countersQuantity; i++) {
        counter[i] = parseInt(counters[i].innerHTML);
    }

    let count = function(start, value, id) {
        let localStart = start;
        setInterval(function() {
            if (localStart < value) {
                localStart++;
                counters[id].innerHTML = localStart;
            }
        }, 40);
    }

    for (let j = 0; j < countersQuantity; j++) {
        count(0, counter[j], j);
    }
});

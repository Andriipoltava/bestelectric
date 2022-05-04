

function resizable(el, factor) {
    var int = Number(factor) || 7.7;

    function resize() {
        el.style.width = ((el.value.length + 1) * int) + 'px'
    }

    var e = 'keyup,keypress,focus,blur,change'.split(',');
    for (var i in e) el.addEventListener(e[i], resize, false);
    resize();
}
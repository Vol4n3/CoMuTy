(function(){
    var bbParses = document.getElementsByClassName('bbParses');
    BBparser.BBtoHtml(bbParses);
    document.addEventListener('DOMContentLoaded',function(){

    });
    setTimeout(function () {
        document.body.style.opacity = "1";
    },200)
})();
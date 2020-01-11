var actions = document.querySelectorAll('.action');
var actionObjs = [];
var cd=1500;
var gcd = 0;

// Request animationFrame

window.requestAnimationFrame = (function(){
    return  window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            window.oRequestAnimationFrame      ||
            window.msRequestAnimationFrame     ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            };
})();

function Cooldown(el) {

    this.canvas = el.querySelector('canvas');
    this.cd = cd;
    this.ctx = this.canvas.getContext('2d');
    this.element = el;
    this.keybind = el.getAttribute('data-keybind');
    this.timer;
    this.timerStart;

    this.clearCanvas = function() {
        this.ctx.setTransform(1, 0, 0, 1, 0, 0);
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    };

    this.endCooldown = function() {
        this.clearCanvas();
        this.timer = null;

        var canvas = this.canvas;
        var ctx = this.canvas.getContext('2d');
        ctx.fillStyle = 'rgba(253, 255, 173, 0.5)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        window.setTimeout(function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }, 20);
    };

    this.gaugeCooldown = function() {
        if (!this.timer) {
            if (gcd.checked) {
                Array.prototype.forEach.call(actionObjs, function(el, i) {
                    if (!actionObjs[i].timer) {
                        actionObjs[i].initiateCooldown();
                    }
                });
            }
            else {
                this.initiateCooldown();
            }
        }
    };

    this.initiateCooldown = function() {
        this.cd = cd;
        if (!this.timer) {
            this.timer = window.setTimeout(this.endCooldown.bind(this), this.cd);
            this.timerStart = (new Date()).getTime();
            this.runCooldown();
        }        
    };

    this.runCooldown = function() {
        if (this.timer) {
            var timeElapsed = (new Date()).getTime() - this.timerStart;
            var timeElapsedPercentage = timeElapsed / this.cd;
            var degrees = 360*timeElapsedPercentage;

            var canvas = this.canvas;
            var ctx = this.canvas.getContext('2d');
            var hypoteneuse = Math.sqrt(Math.pow(this.element.clientWidth, 2) + Math.pow(this.element.clientHeight, 2));
            ctx.setTransform(1, 0, 0, 1, 0, 0);
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            canvas.height = hypoteneuse;
            canvas.width = hypoteneuse;

            canvas.style.marginLeft = -hypoteneuse/2 + "px";
            canvas.style.marginTop = -hypoteneuse/2 + "px";

            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';

            ctx.translate(canvas.width/2, canvas.height/2);
            ctx.rotate(-Math.PI/2);

            ctx.beginPath();
            ctx.moveTo(0, 0);
            ctx.lineTo( (hypoteneuse/2) * Math.cos(0).toFixed(15), (hypoteneuse/2) * Math.sin(0).toFixed(15));
            ctx.lineWidth = 2;
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.9)';

            ctx.shadowColor = 'rgba(255, 255, 255, 0.6)';
            ctx.shadowBlur = 10;

            ctx.stroke();
            ctx.moveTo(0, 0);
            ctx.lineTo((hypoteneuse/2) * Math.cos(degrees * Math.PI/180).toFixed(15), (hypoteneuse/2) * Math.sin(degrees * Math.PI/180).toFixed(15));
            ctx.stroke();

            ctx.shadowColor = null;
            ctx.shadowBlur = null;

            ctx.arc(0, 0, hypoteneuse/2, degrees * Math.PI/180, Math.PI*2, false);
            ctx.fill();
            ctx.closePath();

            requestAnimationFrame(this.runCooldown.bind(this));
        }
    };
}

Array.prototype.forEach.call(actions, function(el, i) {
    var action = new Cooldown(el);
    actionObjs.push(action);

    /*el.addEventListener('click', function() {
        action.gaugeCooldown();
    });*/
});

/*  Keybindings  */

document.addEventListener('keydown', function(event) {
    setTimeout(function(){ 
        var hotkeyValue = String.fromCharCode(event.keyCode);
        if (document.querySelector('#cooldown-length') != document.activeElement) {
            Array.prototype.forEach.call(actionObjs, function(el, i) {
                if (actionObjs[i].keybind === hotkeyValue) {
                    actionObjs[i].element.classList.add('active');
                    window.setTimeout(function() {
                        actionObjs[i].element.classList.remove('active');
                    }, 100);
                    actionObjs[i].gaugeCooldown();
                }
            });
        }
    }, 10);
});
/*
window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);*/
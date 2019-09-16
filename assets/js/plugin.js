$(document).ready(function () {
    $(window).scroll(function () {
        var scroll = $(this).scrollTop();
        var to = 200;
        if (scroll > to) {
            $('.dark-scroll').css({"background": "#000"});
        } else {
            $('.dark-scroll').css({"background": "#fff"});

        }
    });

});

(function () {

    function SVGMenu(el, options) {
        this.el = el;
        this.init();
    }

    SVGMenu.prototype.init = function () {
        this.trigger = this.el.querySelector('button.menu__handle');
        this.shapeEl = this.el.querySelector('div.morph-shape');

        var s = Snap(this.shapeEl.querySelector('svg'));
        this.pathEl = s.select('path');
        this.paths = {
            reset: this.pathEl.attr('d'),
            open: this.shapeEl.getAttribute('data-morph-open'),
            close: this.shapeEl.getAttribute('data-morph-close')
        };

        this.isOpen = false;

        this.initEvents();
    };

    SVGMenu.prototype.initEvents = function () {
        this.trigger.addEventListener('click', this.toggle.bind(this));
    };

    SVGMenu.prototype.toggle = function () {
        var self = this;

        if (this.isOpen) {
            classie.remove(self.el, 'menu--anim');
            setTimeout(function () {
                classie.remove(self.el, 'menu--open');
            }, 250);
        }
        else {
            classie.add(self.el, 'menu--anim');
            setTimeout(function () {
                classie.add(self.el, 'menu--open');
            }, 250);
        }
        this.pathEl.stop().animate({'path': this.isOpen ? this.paths.close : this.paths.open}, 350, mina.easeout, function () {
            self.pathEl.stop().animate({'path': self.paths.reset}, 800, mina.elastic);
        });

        this.isOpen = !this.isOpen;
    };

    new SVGMenu(document.getElementById('menu'));

})();

let count = 0;
$(document).on("click",".next",function () {
    let items = $(".slideimg");
    let itemCount = items.length;
    items[count].classList.remove('active');

    if(count < itemCount - 1) {
        count++;
    } else {
        count = 0;
    }

    console.log(count);
    items[count].classList.add('active');
});

$(document).on("click",".previous",function () {
    let items = $(".slideimg");
    let itemCount = items.length;

    items[count].classList.remove('active');

    if(count > 0) {
        count--;
    } else {
        count = itemCount - 1;
    }

    console.log(count);
    items[count].classList.add('active');
});
// nextItem.addEventListener('click', showNextItem);
// previousItem.addEventListener('click', showPreviousItem);
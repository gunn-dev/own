let price = 5;
let quantity = 2;
let total = 0;
let target = null;
let storage = [];

function record() {
	storage.push(target);
}

function replay() {
	storage.forEach(run => run());
}

target = () => { total = price * quantity };

record();
target();

price = 20;
console.log(total);
replay()
console.log(total);

var vm = new Vue({
	el: '#app',
  data: {
    items: ['a', 'b', 'c']
  }
})


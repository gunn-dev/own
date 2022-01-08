Vue.component('message', {

	props: ['title', 'body'],

	data() {
		return {
			isVisible : true
		};
	},

	template: ` 
		<div class="card mb-4" v-show="isVisible" >
			<div class="card-body">
				<h5 class="card-title bg-success"> {{title}} 
					<button class="btn btn-info" @click="hideModel">x</button>
				</h5>
				<p class="card-text"> {{body}} </p>
			</div>

		</div>
	`,

	methods: {
		hideModel() {
			this.isVisible = false;
		}
	}
});

Vue.component('task-list', {
	template: ` 
		<div>
			<task v-for="task in tasks"> {{ task.task }}</task>
		</div>
	`,

	data() {
		return {
			tasks: [
				{ task: 'Go to the store', complete: true },
				{ task: 'Go to the bank', complete: false },
				{ task: 'Go to the farm', complete: true },
				{ task: 'Go to work', complete: false}
			]
		};
	}
});

Vue.component('task', {
	template: '<li><slot></slot></li>'
});

new Vue({
	el:'#root'
});
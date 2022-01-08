Vue.component('tabs', {
	template: ` 
		<div>
			<div class="tabs">
				<ul class="nav nav-tabs">
				  <li v-for="tab in tabs" class="nav-link"> 
				  		  {{ tab.name }}
				  </li>
				</ul>
			</div>

			<div class="tabs-details">
				<slot></slot>
			</div>
		</div>
	`,
	data() {
		return { tabs: []};
	},
	created() {
		this.tabs = this.$children;
	},
});

Vue.component('tab', {
	template: ` 
		<div><slot></slot></div>
	`,
	props: {
		name: {required: true},
	},
})

new Vue({
	el: '#root'
})
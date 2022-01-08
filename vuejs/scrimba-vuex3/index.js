import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
	state: {
		count: 0
	}
});

new Vue({
	el: '#app',
	computed: {
		count() {
			return store.state.count
		}
	}
})

</script>
<template>
	<div id="home" class="container pt-5">
		<h1>Home Page</h1>
		<p>Count : {{ count }}</p>
		<p>Local Count : {{ countPlusLocalState }}</p>
		<p>Done Todo : {{ doneTodos[0].text }}</p>
		<p>Done Todo Count : {{ doneTodosCount}}</p>
		<input type="text" v-model="message"> <br>
		{{message}} <br><br>
		<button @click="increment" class="btn btn-sm btn-outline-primary">Coun++</button> &nbsp;
		<button @click="decrement" class="btn btn-sm btn-outline-primary">Count--</button>
	</div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
// import { mapGetters } from 'vuex'

export default {
	data() {
		return {
			localCount: 3,
		}
	},
	// computed: {
	// 	count() {
	// 		return this.$store.state.count
	// 	}
	// },
	computed: { 
			...mapState({
			count: state => state.a.count,
			// countAlias: 'count',
			countPlusLocalState(state) {
				return state.a.count + this.localCount
			},
			doneTodos() {
				return this.$store.getters['a/doneTodos']
			},
			
			doneTodosCount() {
				return this.$store.getters['a/doneTodosCount']
			}
		}),
		message: {
			get() {
				return this.$store.state.message
			},
			set(value) {
				this.$store.commit('updateMessage', value)
			}
		}
	},
	// computed: {
	// 	...mapGetters([
	// 		'doneTodosCount', 'doneTodos'
	// 	]),
	// },
	
	// mapState array
	// computed: mapState([
	// 	'count'
	// ]),
	methods: {
		// increment() {
		// 	// this.$store.commit('increment')
		// 	this.$store.dispatch('incrementAsync')
		// },
		// decrement() {
		// 	this.$store.commit('decrement')
		// },
		...mapActions('a/', {
			increment: 'incrementAsync',
			decrement: 'actionB'
			}),
		// ...mapActions([
		// 	'increment'
		// 	])
	}
}
</script>

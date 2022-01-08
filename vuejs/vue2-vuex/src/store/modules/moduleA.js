const moduleA = {
	namespaced: true,
	state: {
		count: 0,
		todos: [
			{ id: 1, text: 'Learn JavaScript', done: true },
			{ id: 2, text: 'Learn VueJS', done: false },
			{ id: 3, text: 'Learn React', done: true }
		]
	},
	mutations: {	
		increment: state => state.count++,
		decrement(state) {
			state.count--
		},
		payloadIncrement: (state, payload) => state.count += payload.amount
	},
	getters: {
		doneTodos: state => state.todos.filter(todo => todo.done),
		doneTodosCount: (state, getters) =>  getters.doneTodos.length,
		getTodoById: (state) => (id) => {
			return state.todos.find(todo=> todo.id === id)
		}
	},
	actions: {
		increment({ commit }) {
			commit('increment')
		},
		incrementAsync({ commit }) {
			setTimeout(()=> {
				commit('increment')
			}, 2000)
		},
		payloadIncrementAsync({commit}, amount) {
			commit('payloadIncrement', amount)
		},
		actionA({ commit }) {
			return new Promise((resolve) => {
				setTimeout(()=> {
					commit('decrement')
					resolve()
				}, 2000)
			})
		},
		actionB({ dispatch, commit }) {
			return dispatch('actionA').then(()=> {
				commit('decrement')
			})
		}
	}
}

export default moduleA
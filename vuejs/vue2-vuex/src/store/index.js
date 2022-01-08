import Vue from 'vue'
import Vuex from 'vuex'
import moduleA from '../store/modules/moduleA'
import moduleB from '../store/modules/moduleB'
import myPlugin from './plugin'
import mutations from '../store/mutations'
// import * as types from './mutation-types'


Vue.use(Vuex);

const store = new Vuex.Store({
	// namespaced: true,
	state: {
		num: 0,
		message: 'Hello'
	},
	mutations,
	actions: {
		num_increment: ({commit}) => commit('NUM_INCREMENT')
	},
	modules: {
		a: moduleA,
		b: moduleB
	},
	plugins: [myPlugin]
})


export default store
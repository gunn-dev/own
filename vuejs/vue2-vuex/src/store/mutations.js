import * as types from './mutation-types'

const mutations = {
	[types.NUM_INCREMENT](state) {
			state.num++
		},
	[types.NUM_DECREMENT]:state => state.num--,
	[types.PAYLOAD_INCREMENT]: (state, payload) => state.num += payload.amount,
	updateMessage(state, e) {
		state.message = e
	}
}
export default mutations
import { expect } from 'chai'
import { mutations } from './mutations'

const { NUM_INCREMENT } = mutations

describe('mutations', ()=> {
	it('NUM_INCREMENT', ()=> {
		const state = { num: 0}
		NUM_INCREMENT(state)
		expect(state.num).toequal(1)
	})
})
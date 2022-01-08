const myPlugin = store => {
	store.subscribe((mutation) => {
		if (mutation.type === 'PAYLOAD_INCREMENT') {
			console.log(mutation.type, mutation.payload)
		}
	}),
	store.subscribeAction((action) => {
		if (action.type === 'num_increment') {
			console.log(action.type)
		}
	})
}

export default myPlugin
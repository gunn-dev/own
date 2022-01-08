<template>
	<div id="user" class="card p-5 my-3 border-primary">
		<h2>User Settings</h2>
		<UserSettingsNav />
		<router-view></router-view> 
		<router-view name="helper"></router-view>
	</div>	
</template>

<script>
import UserSettingsNav from '@/components/UserSettingsNav.vue'
	export default {
		components: {
			UserSettingsNav
		}
	}
</script>
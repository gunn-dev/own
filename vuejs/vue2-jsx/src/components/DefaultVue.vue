<template>
	<div>
		<h1> {{msg}} </h1>
		<div class="row" v-if="countries.length">
			<div class="col-sm-6 col-md-4 col-lg-3 mb-3" v-for="country in countries" :key="country.name">
				<div class="card border-info">
					<div class="card-body">
						<h4 class="card-title">{{ country.name}}</h4>
						<p class="card-text">{{ country.description}}</p>
					</div>
				</div>
			</div>
		</div>
		<div v-else>No Country available</div>
	</div>
</template>

<script>
	export default {
		name: 'DefaultVue',
		props: {
			msg: String
		},

		data() {
    return {
      countries: [
        { name: 'Myanmar', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Korea', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'China', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Indonesia', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Malaysia', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Singapore', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Cambodia', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Japan', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
        { name: 'Vietnam', 
          description: "Nigeria is a large country that has a varied topography. It is about twice the size of the U.S. state of California and is located between Benin and Cameroon. It is the most populated country in africa"
        },
      ]
    }
	}
}
</script>
<template>

    <v-container fluid grid-list-md text-xs-center>

		<v-layout row justify-center>

			<v-flex xs12>

				<v-card :loading="loading">
				
					<template v-if="title">
						<v-card-title dark>
							<h3 class="text--white">{{titulo}}</h3>
							<v-spacer></v-spacer>
							<slot name="HeadTools"></slot>
						</v-card-title>
					</template>

					<v-card-text>
						<v-layout wrap='false' justify-space-between>
							<slot name="fields"></slot>
						</v-layout>
					</v-card-text>

					<v-card-actions>
						<slot name="buttons"></slot>
					</v-card-actions>

				</v-card>

			</v-flex>

		</v-layout>

    </v-container>

</template>

<script>
export default {
    name: 'form-container',
    props:['title', 'help', 'headColor', 'textColor', 'loading', 'valid' ],
}
</script>

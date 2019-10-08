<template>

<v-container fluid>

  <v-layout row wrap>

    <v-flex xs12 sm3 >
      <v-card
        class="mt-3"
        max-width="400"
      >
        <v-sheet
          class="v-sheet--offset mx-auto"
          color="cyan"
          elevation="12"
          max-width="calc(100% - 32px)"
        >

          <v-sparkline
            :labels="labels"
            :value="value2"
            color="white"
            line-width="2"
            padding="16"
          ></v-sparkline>

        </v-sheet>

      <v-card-text class="pt-0">
        <div class="title font-weight-light mb-2">User Registrations</div>
      </v-card-text>
      </v-card>

    </v-flex>

    <v-flex xs12 sm3>
      <v-card
        class="mt-3"
        max-width="400"
      >
        <v-sheet
          class="v-sheet--offset mx-auto"
          color="red"
          elevation="12"
          max-width="calc(100% - 32px)"
        >

          <v-sparkline
            :labels="labels"
            :value="value2"
            color="white"
            line-width="2"
            padding="16"
          ></v-sparkline>

        </v-sheet>

      <v-card-text class="pt-0">
        <div class="title font-weight-light mb-2">User Registrations</div>
      </v-card-text>
      </v-card>

    </v-flex>
    <v-flex xs12 sm3>
      <v-card
        class="mt-3"
        max-width="400"
      >
        <v-sheet
          class="v-sheet--offset mx-auto"
          color="green"
          elevation="12"
          max-width="calc(100% - 32px)"
        >

          <v-sparkline
            :labels="labels"
            :value="value2"
            color="white"
            line-width="2"
            padding="16"
          ></v-sparkline>

        </v-sheet>

      <v-card-text class="pt-0">
        <div class="title font-weight-light mb-2">User Registrations</div>
      </v-card-text>
      </v-card>

    </v-flex>
    <v-flex xs12 sm3>
      <v-card
        class="mt-3"
        max-width="400"
      >
        <v-sheet
          class="v-sheet--offset mx-auto"
          color="yellow"
          elevation="12"
          max-width="calc(100% - 32px)"
        >

          <v-sparkline
            :labels="labels"
            :value="value2"
            color="white"
            line-width="2"
            padding="16"
          ></v-sparkline>

        </v-sheet>

      <v-card-text class="pt-0">
        <div class="title font-weight-light mb-2">User Registrations</div>
      </v-card-text>
      </v-card>



    </v-flex>


    </v-layout>




    <v-layout row wrap mt-2>


    <v-flex xs12 >
      <v-card class="mx-auto text-xs-center">
        <v-card-text>


        <v-progress-circular
        :rotate="360"
        :size="200"
        :width="25"
        :value="value"
        color="teal"
      >
      {{ value }}%
    </v-progress-circular>

    <v-progress-circular
      :rotate="-90"
      :size="200"
      :width="25"
      :value="value"
      color="primary"
    >
      {{ value }}%
    </v-progress-circular>

    <v-progress-circular
      :rotate="90"
      :size="200"
      :width="25"
      :value="value"
      color="red"
    >
      {{ value }}%
    </v-progress-circular>

    <v-progress-circular
      :rotate="180"
      :size="200"
      :width="25"
      :value="value"
      color="pink"
    >
      {{ value }}%
    </v-progress-circular>
        </v-card-text>
      </v-card>

    </v-flex>

 </v-layout>

</v-container>


</template>

<script>
 export default {
    data () {
      return {
        interval: {},
        value: 0,
        value2: [
        423,
        446,
        675,
        510,
        590,
        610,
        760
      ],
      labels: [
        '12am',
        '3am',
        '6am',
        '9am',
        '12pm',
        '3pm',
        '6pm',
        '9pm'
      ],
      }
    },
    beforeDestroy () {
      clearInterval(this.interval)
    },
    mounted () {
      this.interval = setInterval(() => {
        if (this.value === 100) {
          return (this.value = 0)
        }
        this.value += 10
      }, 1000)
    }
  }
</script>
<style scope>
.v-sheet--offset {
    top: -24px;
    position: relative;
  }
</style>

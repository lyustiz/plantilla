<template>
  <v-stepper v-model="steeperStatus">
    <v-stepper-header>
      <template v-for="(element, index) in components">
        <v-stepper-step
          :editable="editable"
          :step="index + 1"
          :key="'HEADER-' + index"
        >{{element.title}}</v-stepper-step>
        <v-divider v-if="index < components.length - 1" :key="'HEADER-DIVIDER-' + index"></v-divider>
      </template>
    </v-stepper-header>

    <v-stepper-items v-for="(element, index) in components" :key="'CONTENT-' + index">
      <v-stepper-content :step="index + 1">
        <div v-if="keepAlive">
          <keep-alive>
            <component :is="element.component" v-bind="element.props"></component>
          </keep-alive>
        </div>

        <div v-else>
          <component :is="element.component" v-bind="element.props"></component>
        </div>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>
<script>
export default {
  props: {
    status: {
      type: Number,
      default: 1
    },
    keepAlive: {
      type: Boolean,
      default: false
    },
    editable: {
      type: Boolean,
      default: false
    },
    components: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      steeperStatus: status
    };
  }
};
</script>
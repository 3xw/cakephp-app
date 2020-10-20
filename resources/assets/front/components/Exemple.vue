<template>
  <div id="exemple">
    <ul class="list-unstyled">
      <li class="alert alert-success">
        {{ msg }}
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'exemple',
  props: {
    name: String
  },
  data () {
    return {
      msg: 'Component test loaded: '+this.name,
    }
  }
};
</script>
<style lang="scss" scoped>
</style>

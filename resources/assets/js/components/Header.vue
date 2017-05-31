
<script>
  export default {
    template: '#header',
    data() {
      return {
        activeIndex: '1',
        activeIndex2: '1'
      };
    },
    methods: {
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>

<style lang="scss">
  header {
    margin-bottom: 30px;
    .menu-right__header {
      float: right;
    }
  }
</style>

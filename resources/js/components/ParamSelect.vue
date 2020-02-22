<template>
  <select v-model="selectValue" class="form-control" :name="selectName" @change="select">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
</template>

<script>
export default {
  props: ['param', 'num'],
  data() {
    return {
      selectName: 'personality_' + this.num,
      selectValue: this.param,
    }
  },
  methods: {
    // 親コンポーネントの値を更新
    select () {
      switch (this.num) {
        case 1 :
          this.$parent.req.personality_1 = this.selectValue
        break;
        case 2 :
          this.$parent.req.personality_2 = this.selectValue
        break;
        case 3 :
          this.$parent.req.personality_3 = this.selectValue
        break;
        case 4 :
          this.$parent.req.personality_4 = this.selectValue
        break;
        case 5:
          this.$parent.req.personality_5 = this.selectValue
        break;
        case 6:
          this.$parent.req.personality_6 = this.selectValue
        break;
      }
    }
  }
}
</script>

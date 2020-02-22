<template>
  <select type="number" class="form-control form-select" name="gender" v-model="selectGender" @change="select">
    <option value="0">男</option>
    <option value="1">女</option>
  </select>
</template>

<script>
export default {
  props:['gender'],
   data() {
    return {
      selectGender: this.gender
     }
   },

   methods: {
    // 親コンポーネントの値を更新
    select() {
      this.$parent.req.gender = this.selectGender
    }
  }
}
</script>
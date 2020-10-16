<template>
  <div class="card-deck" v-bind:class="{ loading: loading }">
    <!-- ロード画面 -->
    <div v-if="loading" class="spinner-border text-primary profile_spiner" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div v-else class="row">
      <div v-for="(user, index) in users"class="col-sm-4 h-auto">
        <div class="flip">
          <div class="card" v-bind:class="{ flipped: isFlip[index]}">
            {{ isFlip.index }}
            <!-- おもて -->
            <div class="face front">
              <div class="card-top">
                <img :src="user.profile.img_file" alt="profile_img">
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ user.profile.name }}</h5>
                <p class="card-text">{{ user.dept.name }}</p>
                <p class="card-text">{{ user.job.name }}</p>
                <p class="card-text">
                  <form :name='"chat_" + user.id' method="POST" action="/groups/create">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <input type="hidden" name="user_id" :value="user_id">
                    <input type="hidden" name="partner_user_id" :value="user.id">
                    <a v-if="user.id != user_id" :href='"javascript:chat_" + user.id +".submit()"'>チャットする</a>
                  </form>
                </p>
                <button @click="flip(index)" type="button" class="flipControl btn btn-primary flip_btn"><i class="fa fa-chevron-right"></i></button>
              </div>
            </div>

            <!-- うら -->
            <div class="face back">
              <div class="card-top">
                <profile-chart :personality="user.profile"></profile-chart>
              </div>
              <div class="card-body">
                <!-- <a :href='`/profiles/${user.id}`'>もっと詳しく</a> -->
                <button @click="flip(index)" type="button" class="flipControl btn btn-primary flip_btn"><i class="fa fa-chevron-left"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import ProfileChart from './ProfileChart'
export default {
    
  // チャートコンポーネント
  components: {
      ProfileChart
  },
  props:['csrf', 'user_id'],
  data() {
    return {
      users: [],
      isFlip:[],
      loading: true,
    }
  },

  mounted: function () {
    var self = this;
    axios.get('/api/users/').then(res => {
          this.users = res.data
          // フリップの配列を作成
          for (var i = 0; i < this.users.length; i++) { 
            this.isFlip[i] = false;
          }
          // console.log(this.isFlip);
          this.loading = false
    })
      .catch(err => {
        // this.errors = err.response.data.errors;
        // this.error_flg = true
        this.loading = false
    });
  },

  methods: {
    // 裏返す
    flip(index) {
      if(this.isFlip[index]) {
        // 表に戻す
        this.$set(this.isFlip, index, false);
      } else {
        // 裏にする
        this.$set(this.isFlip, index, true);
      }
    }
  }
}
Vue.component('profile-chart', ProfileChart)
</script>

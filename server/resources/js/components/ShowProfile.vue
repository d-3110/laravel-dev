<template>
  <div class="card mb-5 profile_card" :class="{ loading : loading }">
    <!-- 更新メッセージ -->
    <div v-if="updated" class="alert alert-primary" role="alert">
      更新しました
    </div>
    <!-- ロード画面 -->
    <div v-if="loading" class="spinner-border text-primary profile_spiner" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <form v-if="!loading" class="row no-gutters">
      <div class="col-md-4 profile_info">

        <!-- 画像表示エリア -->
        <div v-if="!editFlg"class="img_box">
          <img class="card-img-top profile_img" :src="img_file"/>
        </div>
        <!-- 画像編集エリア -->
        <div v-else class="img_box">
          <div data-toggle="modal" data-target="#img_modal" data-whatever="@president">
            <img class="card-img-top profile_img gray_out" :src="img_file"/>
          </div>
          <div class="edit_photo">
            <i class="fui fui-plus"></i>
          </div>
        </div>
        <!-- モーダル -->
        <drop-img @update_img_file="updateImg" :user_id="req.id"></drop-img>

        <!-- 左側通常 -->
        <dl v-if="!editFlg">
          <dt>性別</dt>
          <dd>{{ gender }}</dd>
          <dt>生年月日</dt>
          <dd>{{ req.birthday }}</dd>
          <dt>好きな食べ物</dt>
          <dd>{{ req.favorite_food }}</dd>
          <dt>嫌いな食べ物</dt>
          <dd>{{ req.hated_food }}</dd>
        </dl>
        <!-- 左側編集 -->
        <dl v-else>
          <dt>性別</dt>
          <dd class="form-group">
            <select type="number" class="form-control form-select" name="gender" v-model="req.gender">
              <option value="0" :selected="!is_woman">男</option>
              <option value="1" :selected="is_woman">女</option>
            </select>
          </dd>
          <dt>生年月日</dt>
          <dd class="form-group">
            <input type="text" name="gender" class="form-control" v-model="req.birthday">
          </dd>
          <dt>好きな食べ物</dt>
          <dd>
            <input type="text" name="gender" class="form-control" v-model="req.favorite_food">
          </dd>
          <dt>嫌いな食べ物</dt>
          <dd>
            <input type="text" name="gender" class="form-control" v-model="req.hated_food">
          </dd>
        </dl>
      </div><!-- 左側END -->

      <!-- 右側通常(レーダーチャート) -->
      <div v-if="!editFlg" class="col-md-7">
        <div class="card-body">
          <div>
            <h5 class="card-title">
              {{req.name}}
            </h5>
          </div>
          <profile-chart></profile-chart>
        </div>
      </div>
      <!-- 右側編集エリア -->
      <div v-else class="col-md-7">
        <div class="card-body">
          <dl>
            <dt>なまえ</dt>
            <dd>
              <input type="text" name="name" class="form-control" v-model="req.name">
            </dd>
            <dt>ＨＰ</dt>
            <dd class="form-group">
              <input type="text" name="personality_1" class="form-control" v-model="req.personality_1">
            </dd>
            <dt>ＭＰ</dt>
            <dd class="form-group">
              <input type="text" name="personality_2" class="form-control" v-model="req.personality_2">
            </dd>
            <dt>こうげき</dt>
            <dd class="form-group">
              <input type="text" name="personality_3" class="form-control" v-model="req.personality_3">
            </dd>
            <dt>しゅび</dt>
            <dd class="form-group">
              <input type="text" name="personality_4" class="form-control" v-model="req.personality_4">
            </dd>
            <dt>すばやさ</dt>
            <dd class="form-group">
              <input type="text" name="personality_5" class="form-control" v-model="req.personality_5">
            </dd>
            <dt>かしこさ</dt>
            <dd class="form-group">
              <input type="text" name="personality_6" class="form-control" v-model="req.personality_6">
            </dd>
          </dl>
        </div>
      </div>
    </form><!-- wrrap END -->
    <!-- ボタンエリア　-->
    <div v-if="!editFlg && !loading" class="form-group btn_group">
      <button type="button" class="btn btn-primary edit_btn" @click="(editFlg = true)">
        <i class="fa fa-pencil"></i>
      </button>
    </div>
    <div v-else-if="!loading" class="form-group btn_group">
      <button type="button" class="btn btn-info edit_btn" @click="update">
        <i class="fui fui-check"></i>
      </button>
      <button type="button" class="btn btn-danger edit_btn" @click="(editFlg = false)">
        <i class="fui fui-cross"></i>
      </button>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import ProfileChart from './ProfileChart'
import DropImg from './DropImg'


export default {
    
  // チャートコンポーネント
  components: {
      ProfileChart
  },
  // bladeからデータを受け取り
  props:["profile"],
  data() {
    return {
      // APIでpostするためのreq
      req: {
        id: this.profile.id,
        name: this.profile.name,
        gender: this.profile.gender,
        birthday: this.profile.birthday,
        favorite_food: this.profile.favorite_food,
        hated_food: this.profile.hated_food,
        personality_1: this.profile.personality_1,
        personality_2: this.profile.personality_2,
        personality_3: this.profile.personality_3,
        personality_4: this.profile.personality_4,
        personality_5: this.profile.personality_5,
        personality_6: this.profile.personality_6,
      },
      img_file: this.profile.img_file, // アップロード画像ファイル名
      gender: '',
      editFlg: false,
      updated: false,
      is_woman: false,
      loading: false,
    }
  },

  mounted: function () {
    // 性別の翻訳値を設定
    this.gender = this.setGender(this.profile.gender)
  },

  methods: {
    // 性別設定
    setGender(gender) {
      if (gender == 0) {
        return '男'
      }
      this.is_woman = true
      return '女'
    },
    // 更新処理
    update() {
      this.loading = true
      axios.patch('/api/profiles/' + this.profile.id, this.req).then(res => {
          this.editFlg = false
          this.updated = true
          // 更新後も翻訳値を設定
          this.gender = this.setGender(this.req.gender)
          this.loading = false
      });
    },
    // プロフィール画像を更新
    updateImg(file_path) {
      this.img_file = file_path
    }
  }
}
Vue.component('profile-chart', ProfileChart)
Vue.component('drop-img', DropImg)

</script>

<template>
  <div id="chat" class="card mb-5 chat-card px-2">
    <!-- ロード画面 -->
    <div v-if="loading" class="spinner-border text-primary profile_spiner" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div v-for="m in messages" class="balloon">
      <div v-if="m.user_id != user_id" class="faceicon">
        <img :src="m.img_file" alt="profile_img">
      </div>
      <div v-if="m.user_id != user_id" class="chatting">
        <div class="says">
          <p v-text="m.body"></p>
        </div>
      </div>
      <div v-else class="mycomment">
          <p v-text="m.body"></p>
      </div>
    </div>

    <div class="d-flex justify-content-center">
      <textarea v-model="message" class="message-area" @keyup.ctrl.enter="send()"></textarea>
      <button type="button" @click="send()" class="btn btn-primary">
        <i class="fa fa-paper-plane"></i>
      </button>
    </div>
  </div>
</template>

<script>
  export default {
    props:['group_id', 'user_id'],
    data() {
      return {
        messages: '',
        message: '',
        user_id: this.user_id,
        loading: true,
      }
    },
    mounted: function () {
      this.getMessages()
      Echo.channel('chat')
        .listen('MessageCreated', (e) => {
            // 全メッセージを再読込
            this.getMessages();
        });
    },
    methods: {
      send() {
        // メッセージがからの場合ajaxしない
        if (this.message === '') {
          return
        }
        const params = { 
                        message: this.message,
                        group_id: this.group_id,
                        user_id: this.user_id,
                      }
        axios.post('/api/chat', params).then(res => {
          // 成功したらメッセージクリア
          this.message = ''
        });
      },
      getMessages() {
        axios.get('/api/chat/' + this.group_id).then(res => {
          this.messages = res.data
          this.loading = false
        })
        .catch(err => {
        this.loading = false
        })
      }
    }
  }
</script>

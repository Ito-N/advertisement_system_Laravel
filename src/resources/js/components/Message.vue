<template>
    <div>
        <p v-if="showViewConversationOnSuccess">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop">
                Send Message
            </button>
        </p>
        <p v-else>
            <a href="/messages">
            <button type="button" class="btn btn-success">
                View Conversation
            </button>
            </a>
        </p>

        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Send message to {{ sellerName }}
                            {{ userId }}{{ receiverId }}{{ adId }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea v-model="body" class="form-control" placeholder="please write your message..."></textarea>
                        <p v-if="successMessage">Your message has been sent.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-danger" @click.prevent="sendMessage()">
                            Send message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['sellerName', 'userId', 'receiverId', 'adId'],

    data() {
        return {
            body: '',
            successMessage: false,
            showViewConversationOnSuccess: true
        }
    },
    methods: {
        sendMessage() {
            if (this.body === '') {
                alert('please write your message')
            }
            axios.post('/send/message', {
                body: this.body,
                receiverId: this.receiverId,
                userId: this.userId,
                adId: this.adId
            }).then((response) => {
                this.body = ''
                this.successMessage = true
                this.showViewConversationOnSuccess = false
            })
        }
    }
};
</script>

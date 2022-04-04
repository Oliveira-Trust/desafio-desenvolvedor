
<div x-data="{
        open: false,
        title: '',
        message: '',
        type: 'success',
        errors: []
    }"
    @notify.window="
        open = true;
        title = $event.detail.title;
        message = $event.detail.message;
        if($event.detail.type) {
            type = $event.detail.type
        }
        if($event.detail.errors) {
            errors = $event.detail.errors
        }
        setTimeout(function() {
            open = false;
            errors = [];
            message = '';
            title = '';
            type = 'success'
        }, 5000)"
    class="fixed right-5 top-5 z-50">
    <div x-show="open"
        class=" border-l-4 p-4 mb-2"
        role="alert"
        :class="{
            'bg-green-100 border-green-500 text-green-700': type === 'success',
            'bg-blue-100 border-blue-500 text-blue-700': type === 'alert',
            'bg-red-100 border-red-500 text-red-700': type === 'danger'
        }">
        <p class="font-bold" x-text="title"></p>
        <p x-text="message"></p>

        <template x-for="error in errors">
            <ul>
                <template x-for="msg in error">
                    <li x-text="msg" class="bg-red-100 py-2 px-6 text-red-600 mb-1"></li>
                </template>
            </ul>
        </template>
    </div>
</div>

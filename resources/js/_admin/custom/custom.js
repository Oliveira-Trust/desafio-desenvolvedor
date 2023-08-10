if (_notify_success) {
    (new PNotify({
        text: _notify_success,
        type: 'success',
        styling: 'bootstrap3'
    })).get();
}

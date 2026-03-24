export function showFeedback(element, message, type) {
    if (!element) {
        return;
    }

    element.textContent = message;
    element.className = `message ${type}`;
}

export function clearFeedback(element) {
    if (!element) {
        return;
    }

    element.textContent = '';
    element.className = 'message';
}

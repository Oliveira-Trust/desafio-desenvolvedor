export function getError(objErrors, field) {
    const err = objErrors[field];

    if (err && err.length > 0) {
        return err[0];
    }

    return '';
}

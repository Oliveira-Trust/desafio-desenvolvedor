import ConversionsStateContract from '~/interfaces/ConversionsState'
import Conversion from './Conversion'

export default class ConversionsState implements ConversionsStateContract
{
    conversoes: Array<Conversion>;

    constructor() { this.conversoes = [] }
}

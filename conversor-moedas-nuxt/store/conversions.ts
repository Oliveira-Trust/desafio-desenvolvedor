import Conversion from "~/types/Conversion";
import ConversionsState from "~/types/ConversionsState";

export const state = () => new ConversionsState();

export const mutations = {
    setConversoes(state: ConversionsState, conversoes: Array<Conversion>)
    {
        state.conversoes = conversoes;
    }
};

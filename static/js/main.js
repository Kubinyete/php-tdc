'use strict';

window.phptdc = {
	fecharNotificacao: function(id) {
		$('#'+id).addClass('modoDebugLogPainel__notificacao--desativada');
	}
};
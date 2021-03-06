Scalr.regPage('Scalr.ui.guest.recoverPassword', function (loadParams, moduleParams) {
	return Ext.create('Ext.panel.Panel', {
		width: 420,
		scalrOptions: {
			modal: true
		},
		layout: 'anchor',
		items: [{
			xtype: 'fieldset',
            cls: 'x-fieldset-separator-none x-fieldset-no-bottom-padding',
            title: 'Recover password',
			items: {
				xtype: 'textfield',
				fieldLabel: 'E-mail',
				labelWidth: 45,
				anchor: '100%',
				vtype: 'email',
				name: 'email',
				value: loadParams['email'] || '',
				allowBlank: false
			}
		}],
		dockedItems: [{
			xtype: 'container',
			dock: 'bottom',
			cls: 'x-docked-buttons',
			layout: {
				type: 'hbox',
				pack: 'center'
			},
			items: [{
				xtype: 'button',
				text: 'Reset my password',
                width: 180,
				handler: function () {
					if (this.up('panel').down('[name="email"]').validate()) {
						Scalr.Request({
							processBox: {
								type: 'action'
							},
							scope: this.up('panel'),
							params: {
								email: this.up('panel').down('[name="email"]').getValue()
							},
							url: '/guest/xResetPassword',
							success: function (data) {
								Scalr.event.fireEvent('close', true);
							}
						});
					}
				}
			}, {
				xtype: 'button',
				text: 'Cancel',
				handler: function () {
					Scalr.event.fireEvent('close', true);
				}
			}]
		}],
		itemId: 'recoverForm',
		listeners: {
			activate: function () {
				if (Scalr.user.userId && !Scalr.state.userNeedLogin) {
					Scalr.event.fireEvent('close', true);
				} else if (!Scalr.state.pageSuspend) {
					Scalr.event.fireEvent('lock', true);
				}
			}
		}
	});
});

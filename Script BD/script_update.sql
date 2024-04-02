-- COMANDO PARA ATUALIZAR (UPDATE)

update tb_usuario
	set email_usuario = 'ana@hotmail.com', 
		senha_usuario = 'ana123'
  where id_usuario = 1
  
update tb_categoria
	set id_categoria = 2
  where id_categoria = 3  
  
update tb_categoria
	set id_categoria = 3
  where id_categoria = 4

update tb_empresa
	set id_empresa = 2
  where id_empresa = 3
  
update tb_conta
	set id_conta = 2
  where id_conta = 3
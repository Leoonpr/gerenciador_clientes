$(document).ready(function() {
    const apiUrl = 'app/controller/ClienteController.php';
    const modal = new bootstrap.Modal(document.getElementById('clienteModal'));

    carregarClientes();

    function carregarClientes() {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            data: { action: 'listar' },
            dataType: 'json',
            success: function(clientes) {
                let html = '';
                if (clientes.length > 0) {
                    clientes.forEach(function(cliente) {
                        html += `
                            <tr>
                                <td>${cliente.id}</td>
                                <td>${cliente.nome}</td>
                                <td>${cliente.cpf_cnpj}</td>
                                <td>${cliente.email}</td>
                                <td>${cliente.telefone}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning btn-editar" data-id="${cliente.id}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger btn-excluir" data-id="${cliente.id}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="6" class="text-center">Nenhum cliente cadastrado.</td></tr>';
                }
                $('#tabelaClientes').html(html);
            }
        });
    }

    $('#btnAdicionar').on('click', function() {
        $('#clienteForm')[0].reset();
        $('#clienteId').val('');
        $('#modalTitulo').text('Adicionar Cliente');
    });

    $('#clienteForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = $(this).serialize() + '&action=salvar';

        $.ajax({
            url: apiUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    modal.hide();
                    carregarClientes();
                } else {
                    alert('Ocorreu um erro ao salvar o cliente.');
                }
            }
        });
    });

    $('#tabelaClientes').on('click', '.btn-editar', function() {
        let id = $(this).data('id');
        
        $.ajax({
            url: apiUrl,
            type: 'GET',
            data: { action: 'buscar', id: id },
            dataType: 'json',
            success: function(cliente) {
                $('#modalTitulo').text('Editar Cliente');
                $('#clienteId').val(cliente.id);
                $('#nome').val(cliente.nome);
                $('#cpf_cnpj').val(cliente.cpf_cnpj);
                $('#email').val(cliente.email);
                $('#telefone').val(cliente.telefone);
                modal.show();
            }
        });
    });

    $('#tabelaClientes').on('click', '.btn-excluir', function() {
        let id = $(this).data('id');
        
        if (confirm('Tem certeza que deseja excluir este cliente?')) {
            $.ajax({
                url: apiUrl,
                type: 'POST',
                data: { action: 'excluir', id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        carregarClientes();
                    } else {
                        alert('Ocorreu um erro ao excluir o cliente.');
                    }
                }
            });
        }
    });
});
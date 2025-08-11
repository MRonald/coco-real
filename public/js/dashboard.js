const dados = {
    dia: [
        {produto: "GELO COCO", vendas: 2475, fat: 1937.50},
        {produto: "GELO MORANGO", vendas: 275, fat: 220.00},
        {produto: "GELO MELANCIA", vendas: 250, fat: 195.00},
        {produto: "GELO MAÇÃ VERDE", vendas: 250, fat: 192.50},
        {produto: "GELO MARACUJA", vendas: 200, fat: 160.00},
        {produto: "GELO MISTO", vendas: 25, fat: 0.00},
    ],
    semana: [
        {produto: "GELO COCO", vendas: 9475, fat: 6137.50},
        {produto: "GELO MORANGO", vendas: 275, fat: 220.00},
        {produto: "GELO MELANCIA", vendas: 250, fat: 195.00},
        {produto: "GELO MAÇÃ VERDE", vendas: 250, fat: 192.50},
        {produto: "GELO MARACUJA", vendas: 200, fat: 160.00},
        {produto: "GELO MISTO", vendas: 25, fat: 0.00},
    ]
};

function preencherTabela(id, lista) {
    let tbody = document.getElementById(id);
    tbody.innerHTML = "";
    let totalVendas = 0;
    let totalFat = 0;

    lista.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.produto}</td>
            <td>${item.vendas}</td>
            <td>${item.fat.toLocaleString('pt-BR', {minimumFractionDigits: 2})}</td>
        `;
        tbody.appendChild(row);
        totalVendas += item.vendas;
        totalFat += item.fat;
    });

    document.getElementById(`total-vendas-${id}`).innerText = totalVendas;
    document.getElementById(`total-fat-${id}`).innerText = totalFat.toLocaleString('pt-BR', {minimumFractionDigits: 2});
}

function atualizar(dados = dados) {
    preencherTabela("dia", dados.dia);
    preencherTabela("semana", dados.semana);
    preencherTabela("mes", dados.mes || dados.dia);
    preencherTabela("periodo", dados.periodo || dados.dia);
}

document.addEventListener("DOMContentLoaded", () => {
    if (window.dashboardData) {
        atualizar(window.dashboardData);
    } else {
        atualizar();
    }
});

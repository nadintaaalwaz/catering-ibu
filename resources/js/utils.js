export const rupiah = (n) => 'Rp ' + Number(n).toLocaleString('id-ID');

export const waLink = (site, text) =>
    `https://wa.me/${site?.whatsapp_number ?? ''}?text=${encodeURIComponent(text)}`;
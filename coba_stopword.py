from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
stop_factory = StopWordRemoverFactory()
stopword = stop_factory.create_stop_word_remover()

kalimat = "mereka tiru"
hasil = stopword.remove(kalimat)
print(hasil)
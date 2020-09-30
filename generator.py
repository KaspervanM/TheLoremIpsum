import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
from random import randint
import sys
stderr = sys.stderr
sys.stderr = open(os.devnull, 'w')
from pickle import load
from keras.models import load_model
from keras.preprocessing.sequence import pad_sequences
import sys

# load doc into memory
def load_doc(filename):
    with open(filename, 'r') as file:
    	return file.read()

# generate a sequence from a language model
def generate_seq(model, tokenizer, seq_length, seed_text, n_words):
    result = list()
    in_text = seed_text# generate a fixed number of words
    for _ in range(n_words):
        encoded = tokenizer.texts_to_sequences([in_text])[0] # encode the text as integer
        encoded = pad_sequences([encoded], maxlen = seq_length, truncating = 'pre') # truncate sequences to a fixed length
        yhat = model.predict_classes(encoded, verbose = 0) # predict probabilities for each word
        # map predicted word index to word
        out_word = ''
        for word, index in tokenizer.word_index.items():
            if index == yhat:
                out_word = word
                break
        in_text += ' ' + out_word # append to input
        result.append(out_word)
    return ' '.join(result)


name = str(sys.argv[1])

# load cleaned text sequences
in_filename = 'data/' + name + '/data_sequences.txt'
doc = load_doc(in_filename)
lines = doc.split('\n')
seq_length = len(lines[0].split()) - 1

# load the model
model = load_model('data/' + name + '/weights.best.h5')

# load the tokenizer
tokenizer = load(open('data/' + name + '/tokenizer.pkl', 'rb'))

# make sure nothing is shown
sys.stderr = stderr

words = int(sys.argv[2])
seed_text = lines[randint(0,len(lines)-1)]

# generate new text
generated = generate_seq(model, tokenizer, seq_length, seed_text, words)
print(generated)

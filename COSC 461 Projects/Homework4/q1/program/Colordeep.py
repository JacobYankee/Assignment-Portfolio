#Jacob Yankee
#COSC 461
#Maniccam
#Homework 4
import tensorflow as tf

data = tf.keras.datasets.cifar10

(training_images, training_labels), (test_images, test_labels) = data.load_data()

training_images = training_images/255
test_images = test_images/255

model = tf.keras.models.Sequential([
            tf.keras.layers.Flatten(input_shape=(32, 32, 3)),
            tf.keras.layers.Dense(200, activation=tf.nn.relu),
            tf.keras.layers.Dense(200, activation=tf.nn.relu),
            tf.keras.layers.Dense(10, activation=tf.nn.softmax)
        ])

model.compile(optimizer='sgd', 
              loss='sparse_categorical_crossentropy',
              metrics=['accuracy'])

model.fit(training_images, training_labels, epochs=12)

model.evaluate(test_images, test_labels)

classifications = model.predict(test_images)

print(classifications[0])
print(test_labels[0])


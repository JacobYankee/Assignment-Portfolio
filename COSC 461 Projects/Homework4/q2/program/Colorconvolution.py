#Jacob Yankee
#COSC 461
#Maniccam
#Homework 4
import tensorflow as tf

data = tf.keras.datasets.cifar10

(training_images, training_labels), (test_images, test_labels) = data.load_data()

training_images = training_images.reshape(50000, 32, 32, 3)
test_images = test_images.reshape(10000, 32, 32, 3)
training_images = training_images/255
test_images = test_images/255

model = tf.keras.models.Sequential([
            tf.keras.layers.Conv2D(96, (3, 3), activation='relu', input_shape=(32, 32, 3)),   
            tf.keras.layers.MaxPooling2D(2, 2),  
            tf.keras.layers.Conv2D(96, (3, 3), activation='relu'),    
            tf.keras.layers.MaxPooling2D(2, 2),      
            tf.keras.layers.Flatten(),
            tf.keras.layers.Dense(128, activation=tf.nn.relu),
            tf.keras.layers.Dense(10, activation=tf.nn.softmax)
        ])

model.compile(optimizer='adam', 
              loss='sparse_categorical_crossentropy',
              metrics=['accuracy'])

model.fit(training_images, training_labels, epochs=5)

model.evaluate(test_images, test_labels)

classifications = model.predict(test_images)

print(classifications[0])
print(test_labels[0])



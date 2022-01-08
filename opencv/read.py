import cv2 as cv

img = cv.imread('img/000.cat.jpeg')
cv.imshow('Dog', img)

cv.waitKey(3000)
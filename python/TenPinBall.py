"""
10 pin bowling

1 Game : 10 Frames
1 Frame : 2 Throws

1-9 Frames :
max throws 2
max score 10

10th Frame (special case):
max throws 3 (if 1st throw is Strike)
max score 30

valid Frame input [0-10]

"""


class TenPinBall:
    resultArray = []

    def __init__(self, game_data):
        self.game_data = game_data
        self.resultArray = []

    def get_results(self):
        message, result = self.validate_game_data()
        if not result:
            return message
            #exit(0)
        else:
            idx = 0
            for frame in self.game_data:
                self.resultArray.append(self.calculate_frame_result(frame, idx))
                idx = idx+1
        return self.resultArray

    def calculate_frame_result(self, frame, index):
        if len(self.resultArray) == 0:
            return sum(frame)

        if len(frame) == 1:
        # check for next variable and return it here
            return self.resultArray[-1] + self.calculate_strike(sum(frame), index)
        else:
            return self.resultArray[-1] + sum(frame)

    def calculate_strike(self, sframe, sindex, prevcalc = 0):
        """
        :param sframe: int
        :param sindex: int index of current item
        :param prevcalc: int , temp holder for consecutive strikes
        :return: sum of ith and i+1th element
        """
        if len(self.game_data[sindex+1]) == 1:
            """lookup for consecutive strike, loop until no strike found"""
            prevcalc = prevcalc + sframe
            return self.calculate_strike(sum(self.game_data[sindex+1]), sindex+1, prevcalc)

        else:
            return sframe + sum(self.game_data[sindex+1]) +prevcalc

    def validate_game_data(self,tdata=[]):
        """
        :return: False with Error message or True if given array is clean
        TODO: refactoring atm this block check for all necessay validation
        validations: given input is list of list,
                     size of given data should be 10,
                     1-9 Frame must have size 1 or 2,
                     elements of Frame must be 0 <= element <=10
                     addition must not exceed to 10,
                     special case for 10th Frame

        """
        for i in range(len(self.game_data) - 1):
            if not (isinstance(self.game_data[i], list)):
                return 'Invalid Game Data', False
        if len(self.game_data) != 10:
            return 'Invalid Game Length', False
        for i in range(len(self.game_data)-1):
            frame = self.game_data[i]

            if not (len(frame) == 2 or len(frame) == 1):
                return 'Invalid Frame data : ' + str(self.game_data[i]), False
            if len(frame) == 2:
                if not (self.game_data[i][0] in range(0, 11) and self.game_data[i][1] in range(0, 11)):
                    return "Not In range " + str(self.game_data[i]), False
            else:
                if not (self.game_data[i][0] in range(10, 11)):
                    return "Not Valid Result " + str(self.game_data[i]), False
            """Frame score should not exceed 10"""
            if sum(self.game_data[i]) > 10:
                return "Not Valid Result, maximum score of 10 is allowed,  given: " + str(self.game_data[i]), False

        """10th Frame"""
        if self.game_data[9][0] != 10 and len(self.game_data[9]) == 3:
            # boundary condition to check if 1st element is strike
            return 'Invalid Frame data : ' + str(self.game_data[9]), False
        if not (len(self.game_data[9]) in range(2, 4)):
            return 'Invalid Frame data : ' + str(self.game_data[9]), False
        if len(self.game_data[9]) == 2:
                if not (self.game_data[9][0] in range(0, 11) and self.game_data[9][1] in range(0, 11)):
                    return "Not In range" + str(self.game_data[9]), False
        if len(self.game_data[9]) == 3:
                if not (self.game_data[9][0] in range(0, 11) and self.game_data[9][1] in range(0, 11) and self.game_data[9][2] in range(0, 11)):
                    return "Not In range" + str(self.game_data[9]), False
        if sum(self.game_data[9]) > 30:
            return "Not Valid Result, maximum score of 30 is allowed " + str(self.game_data[9]), False

        return '_', True

print('\n')
print('-' * 4 + 'Valid inputs' + '-' * 4)
print('\n')
tenpinball = TenPinBall([[5,5],[8,1],[6,4],[10],[0,5],[2,6],[8,1],[5,3],[6,1],[10,2,6]])
print(tenpinball.get_results())
tenpinball = TenPinBall([[5,2],[8,1],[6,4],[10],[10],[2,6],[8,1],[5,3],[6,1],[10,2,6]])
print(tenpinball.get_results())
tenpinball = TenPinBall([[1,3],[2,5],[1,7],[10],[10],[5,3],[2,1],[1,1],[1,3],[10,2,1]])
print(tenpinball.get_results())

print('\n')
print('-' * 4 + 'Invalid inputs' + '-' * 4)
print('\n')
tenpinball = TenPinBall('test string')
print(tenpinball.get_results())
tenpinball = TenPinBall([[8,1],[6,4],[10],[10],[2,6],[8,1],[5,3],[6,1],[10,2,6]])
print(tenpinball.get_results())
tenpinball = TenPinBall([[10,5],[8, 6], [6, 4], [10], [10], [2, 6], [8, 1], [5, 3], [6, 1], [10, 2, 6]])
print(tenpinball.get_results())
tenpinball = TenPinBall([[1,5],[1, 6], [6, 4], [10], [10], [2, 6], [8, 1], [5, 3], [6, 1], [10, 12, 6]])
print(tenpinball.get_results())
tenpinball = TenPinBall([[1,5],[1, 6], [6, 4], [10], [10], [2, 6], [8, 1], [5, 3], [6, 1],  [6, 1],  [6, 1], [10, 12, 6]])
print(tenpinball.get_results())

